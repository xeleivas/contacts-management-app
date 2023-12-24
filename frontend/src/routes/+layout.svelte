<script>
	import '../app.css';
	import { onMount } from 'svelte';
	import { goto } from '$app/navigation';
	import { page } from '$app/stores';
	import { isLoggedIn, checkAuth } from '$lib/stores/auth';

	let hideBackButton = true;

	$: $page.url.pathname, (hideBackButton = ['/', '/login'].includes($page.url.pathname));

	onMount(async () => {
		// If the user is already logged in we don't need to check this
		if ($isLoggedIn) return;
		// Check if the user is logged in
		await checkAuth();
		// If the user is logged in and is trying to access the login page, redirect to the home page
		// If the user is not logged in and is trying to access any page other than the login page, redirect to the login page
		if (!$isLoggedIn && $page.url.pathname !== '/login') goto('/login');
	});
</script>

<div class="w-screen h-full bg-custom-background">
	<!-- Navbar -->
	<div
		class="h-14 flex justify-start items-end bg-custom-background md:h-24 md:items-center md:bg-custom-pink md:p-4"
	>
		<a class="flex justify-center items-center ml-4 md:ml-0" class:hidden={hideBackButton} href="/">
			<img src="/img/back-arrow.svg" class="w-4 h-4" alt="Back" />
			<span class="ml-2 text-custom-text text-lg font-semibold">Back</span>
		</a>
	</div>
	<!-- Slot section -->
	<div class="flex justify-center items-center">
		<div class="w-full min-h-full flex flex-col items-center md:min-h-screen md:mb-10">
			<slot />
		</div>
	</div>
</div>
