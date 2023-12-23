<script>
	import ContactProfileBanner from '$lib/components/contacts/ContactProfileBanner.svelte';
	import { page } from '$app/stores';
	import { onMount } from 'svelte';
	import { goto } from '$app/navigation';
	import { fetchContacts, getContact } from '$lib/stores/contacts';

	let contact = {};
	const contactId = parseInt($page.params.id);

	onMount(async () => {
		await fetchContacts();
		contact = getContact(contactId);
		console.log({ contact });
		if (!contact) goto('/');
	});
</script>

<svelte:head>
	<title>Contact Edit</title>
</svelte:head>

{#if contact}
	<div class="w-full flex flex-col items-start relative min-h-[95vh]">
		<ContactProfileBanner
			picture={contact.profile_picture_url}
			name={contact.name}
			contactId={contact.id}
		/>
	</div>
{/if}
