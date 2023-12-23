<script>
	import '../app.css';
	import { onMount } from 'svelte';
	import { goto } from '$app/navigation';
	import { page } from '$app/stores';
	import { isLoggedIn, checkAuth } from '$lib/stores/auth';

	onMount(async () => {
		if ($isLoggedIn || $page.url.pathname === '/login') return;
		await checkAuth();
		if (!$isLoggedIn) goto('/login');
	});
</script>

<div class="w-screen h-screen">
	<!-- Desktop navbar -->
	<div class="h-24 bg-custom-pink hidden md:flex p-4"></div>
	<!-- Slot section -->
	<div class="flex justify-center items-center">
		<div class="w-full">
			<slot />
		</div>
	</div>
</div>
