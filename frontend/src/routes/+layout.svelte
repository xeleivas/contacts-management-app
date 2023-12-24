<script>
	import '../app.css';
	import Navbar from '$lib/components/elements/Navbar.svelte';

	import config from '$lib/config';
	import { onMount } from 'svelte';
	import { goto } from '$app/navigation';
	import { page } from '$app/stores';
	import { isLoggedIn, checkAuth } from '$lib/stores/auth';

	onMount(async () => {
		// If the user is already logged in we don't need to check this
		if ($isLoggedIn) return;
		// Check if the user is logged in
		await checkAuth();
		// If the user is logged in and is trying to access the login page, redirect to the home page
		if ($isLoggedIn && $page.url.pathname === '/login') goto('/');
		// If the user is not logged in and is trying to access any page other than the login page, redirect to the login page
		if (!$isLoggedIn && $page.url.pathname !== '/login') goto('/login');
	});
</script>

<svelte:head>
	<!-- Google Places API -->
	<script>
		// Workaround to avoid initialization errors
		window.initMap = () => ({});
	</script>
	<script
		async
		src={`https://maps.googleapis.com/maps/api/js?key=${config.placesApiKey}&libraries=places&language=en&callback=initMap`}
	></script>
</svelte:head>

<div class="w-screen h-full bg-custom-background">
	<!-- Navbar -->
	<Navbar />
	<!-- Slot section -->
	<div class="flex justify-center items-center">
		<div class="w-full min-h-full flex flex-col items-center md:min-h-screen md:mb-10">
			<slot />
		</div>
	</div>
</div>
