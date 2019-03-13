<h1>Aplikasi Rapat Koordinasi</h1>

Tutorial Install : 
<p>Jalankan pada terminal/cmd </p>

<p>git Clone https://github.com/curlykun/rakordir.git</p>

<p>cd rakordir</p>

<p>composer update</p>
<hr>

<p>ubah nama file .env.example ke .env</p>

<p>atur koneksi database pada .env</p>
<hr>

<p>Jalankan pada terminal/cmd </p>
<p>php artisan key:generate</p>
<p>php artisan migrate:refresh --seed</p>
<p>php artisan config:cache</p>