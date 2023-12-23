<script>
	import ContactProfileBanner from '$lib/components/contacts/ContactProfileBanner.svelte';
	import ContactEdit from '$lib/components/contacts/ContactEdit.svelte';

	let contact = {};
</script>

<svelte:head>
	<title>Contact Creation</title>
</svelte:head>

{#if contact}
	<div class="w-full flex flex-col items-start relative min-h-[95vh]">
		<ContactProfileBanner
			picture={contact.profile_picture_url}
			name={contact.name}
			contactId={contact.id}
		/>

		<!-- Create section -->
		<ContactEdit create />
	</div>
{/if}
