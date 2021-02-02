const mix = require('laravel-mix');



mix.js('resources/js/app.js', 'public/js')
	.sass('resources/sass/main.scss', 'public/css')
	// .sass('resources/sass/dashboard.scss', 'public/css')
	.sass('resources/sass/profiles/show.scss', 'public/css/profiles')
	.sass('resources/sass/profiles/edit.scss', 'public/css/profiles');