<script>
	import { isLoggedIn } from '$lib/stores/auth';
</script>

<svelte:head>
	<title>Contacts Management</title>
</svelte:head>

{#if $isLoggedIn}
	<h1>Welcome to SvelteKit</h1>
	<p>Visit <a href="https://kit.svelte.dev">kit.svelte.dev</a> to read the documentation</p>
{/if}
