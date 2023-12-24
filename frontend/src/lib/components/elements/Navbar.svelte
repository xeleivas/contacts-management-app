<script>
	import { goto } from '$app/navigation';
	import { page } from '$app/stores';
	import { logout } from '$lib/stores/auth';

	let hideBackButton = true;
	let hideLogoutButton = true;

	$: {
		hideBackButton = ['/', '/login'].includes($page.url.pathname);
		hideLogoutButton = $page.url.pathname === '/login';
	}

	const handleLogout = async () => {
		await logout();
		goto('/login');
	};
</script>

<!-- Navbar -->
<div
	class="h-14 flex items-end bg-custom-background md:h-24 md:items-center md:bg-custom-pink md:p-4"
	class:justify-between={!hideBackButton}
	class:justify-end={hideBackButton}
>
	<a class="flex justify-center items-center ml-4 md:ml-0" class:hidden={hideBackButton} href="/">
		<img src="/img/back-arrow.svg" class="w-4 h-4" alt="Back" />
		<span class="ml-2 text-custom-text text-lg font-semibold">Back</span>
	</a>
	<button
		class="ml-2 text-custom-text text-lg font-semibold mr-4"
		class:hidden={hideLogoutButton}
		on:click={handleLogout}
	>
		Logout
	</button>
</div>
