<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AppGenerator extends Command
{
    protected $name = 'AppGenerate';
    protected $description = 'Kurulum Yapılıyor...';
    protected $user = array(
        'fullname' => null,
        'username' => null,
        'email' => null,
        'password' => null,
        'created_at' => null,
        'status' => 1,
    );
    
    protected $settings = array(
        'mail' => null,
        'analytics' => 'Analytics Kodu',
        'address' => 'Adres Bilgisi',
        'created_at' => null
    );

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        Schema::dropIfExists('migrations');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('users');
        Schema::dropIfExists('galeries');
        Schema::dropIfExists('images');
        Schema::dropIfExists('settings');
        
        $this->comment  ('');
        $this->comment  ('##########################################################');
        $this->comment  ('##                                                      ##');
        $this->info     ('##  Merhaba;                                            ##');
        $this->comment  ('##                                                      ##');
        $this->info     ('##  Kurulumdan Once Panel icin bir kullanici Olusturun. ##');
        $this->info     ('##  Kullanici Adi Girerken Turkce Karakter Girmeyin.    ##');
        $this->comment  ('##                                                      ##');
        $this->comment  ('##########################################################');
        $this->comment  ('');
        
        $this->askUserFullName();
        $this->askUserUsername();
        $this->askUserEmail();
        $this->askUserPassword();
        
        $this->comment  ('');
        $this->comment  ('##########################################################');
        $this->comment  ('##                                                      ##');
        $this->info     ('##  Tebrikler. Kullaniciyi Olusturdun.                  ##');
        $this->comment  ('##                                                      ##');
        $this->info     ('##  Simdi Iletisim Formu Icin Mail Adresi Girmelisin.   ##');
        $this->comment  ('##                                                      ##');
        $this->comment  ('##########################################################');
        $this->comment  ('');
        
        $this->askSettingsEmail();
        
        $this->call('key:generate');
        $this->call('migrate:install');
        $this->call('migrate');
        
        $this->UserGenerate();
        
        $this->SettingsSave();
        
        $this->call('db:seed');
    }
    
    // Kullanıcı İsmi Girme Fonksiyonu
    protected function askUserFullName(){
        do{
            $fullname = $this->ask('Kullanici Ad / Soyad : ');
            if($fullname == ""){
                $this->comment("");
                $this->comment("#-----------------------------------------------#");
                $this->info   ("# **Devam Etmek Icin Ad / Soyad Girmelisiniz.** #");
                $this->comment("#-----------------------------------------------#");
                $this->comment("");
            }
        }while(!$fullname);
        $this->user['fullname'] = $fullname;
    }
    
    // Kullanıcı Adı Girme Fonksiyonu
    protected function askUserUsername(){
        do{
            $this->comment("");
            $username = $this->ask('Kullanici Adi : ');
            if($username == ""){
                $this->comment("");
                $this->comment("#----------------------------------------------------#");
                $this->info   ("# **Devam Etmek Icin Kullanici Adini Girmelisiniz.** #");
                $this->comment("#----------------------------------------------------#");
            }
        }while(!$username);
        $this->user['username'] = $username;
    }
    
    // Kullanıcı Email Girme Fonksiyonu
    protected function askUserEmail(){
        do{
            $this->comment("");
            $email = $this->ask('Kullanici Email Adresi : ');
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $this->comment("");
                $this->comment("#------------------------------------#");
                $this->info   ("# **Email Adresiniz Gecerli Degil.** #");
                $this->comment("#------------------------------------#");
                $email = "";
            }
        }while(!$email);
        $this->user['email'] = $email;
    }
    
    // Kullanıcı Parolası Girme Fonksiyonu
    protected function askUserPassword(){
        do{
            $this->comment("");
            $password = $this->ask('Kullanici Parolasi : ');
            if(strlen($password) < 6){
                $this->comment("");
                $this->comment("#-------------------------------------------------------------------#");
                $this->info   ("# **Kullanici Parolasi Kisa. Parola En Az 6 Karakterli Olmalidir.** #");
                $this->comment("#-------------------------------------------------------------------#");
            }
        }while(strlen($password) < 6);
        $this->user['password'] = Hash::make($password);
    }
    
    // Kullanıcıyo Oluşturma Fonksiyonu
    protected function UserGenerate(){
        DB::table("users")->insert($this->user);
    }
    
    // Kullanıcı Email Girme Fonksiyonu
    protected function askSettingsEmail(){
        do{
            $this->comment("");
            $mail = $this->ask('Settings Email Adresi : ');
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $this->comment("");
                $this->comment("#------------------------------------#");
                $this->info   ("# **Email Adresi Gecerli Degil.**    #");
                $this->comment("#------------------------------------#");
                $mail = "";
            }
        }while(!$mail);
        $this->settings['mail'] = $mail;
    }
    
    // Kullanıcıyo Oluşturma Fonksiyonu
    protected function settingsSave(){
        $this->settings['created_at'] = date("Y-m-d H:i:s");
        DB::table("settings")->insert($this->settings);
    }
    
}
