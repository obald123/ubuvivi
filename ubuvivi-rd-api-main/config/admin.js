module.exports = ({ env }) => ({
  auth: {
    secret: env('ADMIN_JWT_SECRET', 'eae64d1cd622884d8d33e39bc99c71df'),
  },
});
