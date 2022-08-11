<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      if (Schema::hasTable('smtps')) {
         $mail = DB::table('smtps')->first();
         if($mail)
         {
            $config = [
                'driver' => $mail->mailer,
                'host' => $mail->host,
                'port' => $mail->port,
                'from' => array('address' => $mail->sender, 'name' => $mail->displayname),
                'encryption' => $mail->encryption,
                'username' => $mail->username,
                'password' => $mail->password,
                'sendmail' => '/usr/sbin/sendmail -bs',
                'pretend' => false
            ];

            Config::set('mail', $config);
         }
          
      }

     
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
