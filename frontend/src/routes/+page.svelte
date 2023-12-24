<script>
	import SearchBar from '$lib/components/elements/SearchBar.svelte';
	import ContactCard from '$lib/components/contacts/ContactCard.svelte';
	import Button from '$lib/components/elements/Button.svelte';
	import { onMount } from 'svelte';
	import { goto } from '$app/navigation';
	import { isLoggedIn } from '$lib/stores/auth';
	import { contacts, fetchContacts } from '$lib/stores/contacts';

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
		goto('/contact/create');
	};

	// Hooks
	onMount(async () => {
		await fetchContacts();
		filteredContacts = filterContacts();
	});

	$: searchText, (filteredContacts = filterContacts());
</script>

<svelte:head>
	<title>Contacts Management</title>
</svelte:head>

{#if $isLoggedIn}
	<div class="w-full flex flex-col items-start relative min-h-[95vh]">
		<div class="w-11/12 mx-auto">
			<h1 class="mt-24 mb-4 text-custom-title font-black md:mb-9">Contacts</h1>
			<SearchBar bind:value={searchText} />
		</div>

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
			<div
				class="w-full flex flex-wrap justify-start mt-8 mb-24 mx-auto md:w-9/12 md:mt-16 md:mb-0"
			>
				{#each filteredContacts as contact, index}
					<div class="w-full md:w-1/3 md:p-2">
						<ContactCard {contact} noBackground={index % 2 !== 0} />
					</div>
				{/each}
			</div>
		{/if}

		<!-- Button section -->
		<div class="w-full hidden md:flex justify-center mt-9">
			<div class="w-64">
				<Button type="button" text="Add new contacts" onClick={addNewContact} />
			</div>
		</div>
		<div class="absolute bottom-10 right-0 mr-8 flex justify-center md:hidden">
			<button on:click={addNewContact}>
				<img src="img/plus-icon.svg" alt="Add new contact" />
			</button>
		</div>
	</div>
{/if}
