Laravel-Admin-Paneli
====================

Laravel 4.1.* ile hazırlanmış örnek uygulama.

Laravel Kod Örneği
Bu kod örneğini Laravel kullanmak istediğiniz projelerinizde hazırlayacağınız admin panellerine örnek olarak hazırlanmıştır. Ayrıca Template sistemi, oturum yönetimi, Routes yönetimi vs. işlemler hakkında da bilgi sahibi olabilirsiniz. Çok aşırı gelişmiş işlemler basitlik açısından kullanılmamıştır. Soru ve görüşlerininizi <a href="http:www.webteders.com/iletisim" target="_blank">İletişim</a> adresinden paylaşabilirsiniz.

Kurulum
- Git komut satırından dosyaları çekin.
	<pre> git clone https://github.com/tesican/Laravel-Admin-Paneli.git dashboard<pre>
- Komut satırından laravelin kurulumunu yapın.
	<pre>composer install</pre>
- Öncelikle app/config/database.php dosyasından database ayarlarını girin.
	<pre>
		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'databaseadi',
			'username'  => 'root',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
	</pre>
- Database ayarlarını yaptıktan sonra komut satırından panel kurulumunu yapın.
	<pre> php artisan AppGenerate </pre>
- Kurulum komutundan sonra tablolar database'e yüklenecektir, yükleme sırasında kişisel verileri komut satırından girin.
	
