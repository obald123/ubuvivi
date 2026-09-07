<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetBookings extends Command
{
    /**
     * php artisan bookings:reset          — interactive, asks for confirmation
     * php artisan bookings:reset --force  — no prompt, for non-interactive use
     *
     * @var string
     */
    protected $signature = 'bookings:reset {--force : Skip the confirmation prompt}';

    /**
     * @var string
     */
    protected $description = 'Permanently delete all booking/request records (tours, car rentals, transfers, flights, hotels) and their admin notifications. Does NOT touch the service catalog (tours, vehicles, hotels, blog posts, etc).';

    /**
     * Tables holding booking/request data. Deleting rows here never
     * touches the catalog tables (itinerary, vehicles, hotels, ...).
     */
    private const BOOKING_TABLES = [
        'vehicle_bookings', // pivot: which vehicle was linked to a car booking/transfer
        'tour_bookings',
        'car_bookings',
        'car_transfers',
        'flight_bookings',
        'hotel_bookings',
    ];

    /**
     * admin_notifications also stores non-booking types (e.g. "contact"),
     * so only these types are cleared — contact messages are left alone.
     */
    private const BOOKING_NOTIFICATION_TYPES = [
        'tour_booking',
        'car_booking',
        'transfer_booking',
        'flight_booking',
        'hotel_booking',
        'event_booking',
    ];

    public function handle(): int
    {
        $counts = [];
        foreach (self::BOOKING_TABLES as $table) {
            $counts[$table] = DB::table($table)->count();
        }
        $counts['admin_notifications (booking-related)'] = DB::table('admin_notifications')
            ->whereIn('type', self::BOOKING_NOTIFICATION_TYPES)
            ->count();

        $this->table(
            ['Table', 'Rows that will be deleted'],
            collect($counts)->map(fn ($count, $table) => [$table, $count])->values()->all()
        );

        if (array_sum($counts) === 0) {
            $this->info('Nothing to delete — bookings/requests are already empty.');
            return self::SUCCESS;
        }

        if (!$this->option('force') && !$this->confirm('This permanently deletes all rows listed above. Continue?')) {
            $this->warn('Aborted — no changes made.');
            return self::SUCCESS;
        }

        DB::transaction(function () {
            foreach (self::BOOKING_TABLES as $table) {
                DB::table($table)->delete();
            }

            DB::table('admin_notifications')
                ->whereIn('type', self::BOOKING_NOTIFICATION_TYPES)
                ->delete();
        });

        $this->info('Done. All bookings, requests, and their admin notifications have been cleared. Services/catalog data is untouched.');

        return self::SUCCESS;
    }
}
