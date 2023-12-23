<script>
	import '../app.css';
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

<div class="w-screen h-screen">
	<!-- Desktop navbar -->
	<div class="h-24 bg-custom-pink hidden md:flex p-4"></div>
	<!-- Slot section -->
	<div class="flex justify-center items-center">
		<div class="w-full min-h-screen flex flex-col items-center">
			<slot />
		</div>
	</div>
</div>
