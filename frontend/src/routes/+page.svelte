<script>
	import SearchBar from '$lib/components/elements/SearchBar.svelte';
	import Button from '$lib/components/elements/Button.svelte';
	import { onMount } from 'svelte';
	import { goto } from '$app/navigation';
	import { isLoggedIn } from '$lib/stores/auth';
	import { contacts, getContacts } from '$lib/stores/contacts';

	let searchText = '';
	let filteredContacts = [];

	// Filter the contacts based on the search text
	const filterContacts = () => {
		if (searchText === '') return $contacts;
		const searchTextLower = searchText.toLowerCase();

		return $contacts.filter((contact) => {
			return (
				contact.name.toLowerCase().includes(searchTextLower) ||
				contact.email.toLowerCase().includes(searchTextLower) ||
				contact.phone_number.toLowerCase().includes(searchTextLower)
			);
		});
	};

	const addNewContact = async () => {
		goto('/create');
	};

	// Hooks
	onMount(async () => {
		await getContacts();
	});

	$: searchText, (filteredContacts = filterContacts());
</script>

<svelte:head>
	<title>Contacts Management</title>
</svelte:head>

{#if $isLoggedIn}
	<div class="w-11/12 flex flex-col items-start min-h-screen">
		<h1 class="mt-24 mb-9 text-blue-950 font-black">Contacts</h1>
		<SearchBar bind:value={searchText} />

		{#if $contacts.length === 0}
			<!-- Not found section -->
			<div class="w-full flex flex-col justify-center items-center mt-24 md:mt-32">
				<div class="w-48 h-48 relative">
					<img src="img/circle.svg" class="w-full h-full absolute inset-0 m-auto" alt="Circle" />
					<img
						src="img/contacts-not-found.png"
						class="w-32 h-24 absolute inset-0 m-auto"
						alt="Contacts Not Found"
					/>
					<img src="img/line.svg" class="w-28 h-36 absolute inset-0 m-auto" alt="Line" />
				</div>
				<p class="max-w-52 text-center text-xl font-bold text-custom-label mt-6">
					Add contacts to your database
				</p>
			</div>
		{:else}
			{#each filteredContacts as contact}
				<div class="flex flex-col justify-center items-center gap-y-5">
					<p>{contact.name}</p>
					<p>{contact.email}</p>
					<p>{contact.phone_number}</p>
				</div>
			{/each}
		{/if}

		<!-- Button section -->
		<div class="w-full hidden md:flex justify-center mt-9">
			<Button type="button" text="Add new contacts" onClick={addNewContact} />
		</div>
		<div class="fixed bottom-0 right-0 mb-11 mr-8 md:hidden flex justify-center">
			<button on:click={addNewContact}>
				<img src="img/plus-icon.svg" alt="Add new contact" />
			</button>
		</div>
	</div>
{/if}
