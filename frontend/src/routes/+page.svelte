<script>
	import { onMount } from 'svelte';
	import { goto } from '$app/navigation';
	import { isLoggedIn, checkAuth } from '$lib/stores/auth';

	onMount(async () => {
		await checkAuth();
		if (!$isLoggedIn) goto('/login');
	});
</script>

<svelte:head>
	<title>Contacts Management</title>
</svelte:head>

<h1>Welcome to SvelteKit</h1>
<p>Visit <a href="https://kit.svelte.dev">kit.svelte.dev</a> to read the documentation</p>

<p>isLoggedIn: {$isLoggedIn}</p>
