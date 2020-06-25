<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class emailslistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('emailslist')->truncate();
        \DB::table('email_template')->truncate();
	    $table = [
            [
                'unique_name' => 'BookingRequestAccepted',
                'title' => 'Booking Request Accepted Email Template',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'CreateListingEmail',
                'title' => 'Create Listing Email',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'ListBookingRequest',
                'title' => 'List Booking Request',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'ListHostName',
                'title' => 'List Host Name',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'paymentStatusEscrowEmail',
                'title' => 'payment Status Escrow Email Template',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'paymentStatusReleaseEscrowEmail',
                'title' => 'payment Status Release Escrow Email Template',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'RoomBookingAcceptRejectEmilclient',
                'title' => 'Room Booking Accept Reject Email Template for client',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'RoomBookingAcceptRejectEmilhost',
                'title' => 'Room Booking Accept Reject Email Template for Host',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'RoomBookingClientEmail',
                'title' => 'Room Booking Client Email Template',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'RoomBookingHosttEmail',
                'title' => 'Room Booking Host Email Template',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'SocialAccountConnectedEmail',
                'title' => 'SocialAccountConnectedEmail',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'DeactivateAccountEmail',
                'title' => 'Deactivate Account Email',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'PasswordUpdateEmail',
                'title' => 'Password Update Email',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'PasswordReset',
                'title' => 'Password Reset',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'RegistrationConfirmationEmail',
                'title' => 'User sign up / Registration Confirmation Email',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'ResendVerificationMail',
                'title' => 'Resend Verification Mail',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'SocialRegistrationEmail',
                'title' => 'Social Registration Email',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unique_name' => 'InviteEmailTemplate',
                'title' => 'Invite Email Template',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

	    ];
	    \DB::table('emailslist')->insert($table);
    }
}
