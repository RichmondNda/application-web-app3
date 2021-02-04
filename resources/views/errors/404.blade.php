<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


</head>
<body>
    <div>
		<div class="text-center">
			<div class=" mt-40">
				<h1 class="font-bold text-9xl text-red-700">Oops!</h1>
			</div>
			<div class="mt-5">
        <span class="text-xl text-yellow-400 font-semibold">404 - Page non trouvé </span>
      </div>
      <div class="m-8 flex justify-center pr-6">
        <a href="/" class=" bg-gradient-to-r from-yellow-200 to-yellow-400 text-red-800 font-bold py-2 px-4 rounded-lg
                focus:outline-none focus:shadow-outline ">Aceuille</a>
    </div>

			{{-- <router-link :to="{ name: 'Page_Acceuille' }"  >  Acceuille  </router-link> --}}
		</div>
	</div>
</body>
</html>