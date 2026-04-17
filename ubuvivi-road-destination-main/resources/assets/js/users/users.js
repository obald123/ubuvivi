'use strict';

let tableName = '#usersTable';
$(tableName).DataTable({
    scrollX: true,
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: recordsURL,
    },
    columnDefs: [
        {
            'targets': [7],
            'orderable': false,
            'className': 'text-center',
            'width': '8%',
        },
    ],
    columns: [
        {
            data: 'name',
            name: 'name'
        },{
            data: 'email',
            name: 'email'
        },{
            data: 'email_verified_at',
            name: 'email_verified_at'
        },{
            data: 'password',
            name: 'password'
        },{
            data: 'two_factor_secret',
            name: 'two_factor_secret'
        },{
            data: 'two_factor_recovery_codes',
            name: 'two_factor_recovery_codes'
        },{
            data: 'remember_token',
            name: 'remember_token'
        },
        {
            data: function (row) {
                let url = recordsURL + row.id;
                let data = [
                {
                    'id': row.id,
                    'url': url + '/edit',
                }];
                                
                return prepareTemplateRender('#usersTemplate',
                    data);
            }, name: 'id',
        },
    ],
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(recordsURL + recordId, tableName, 'User');
});
