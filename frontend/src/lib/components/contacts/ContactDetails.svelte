<script>
	import InfoDisplay from '$lib/components/elements/InfoDisplay.svelte';
	import Button from '$lib/components/elements/Button.svelte';
	import { goto } from '$app/navigation';

	export let contact = {};

	const goToEdit = () => {
		goto(`/contact/${contact.id}/edit`);
	};
</script>

<div class="w-full flex justify-center items-center mt-8 md:mt-20 md:ml-14">
	<div class="grid grid-cols-1 md:grid-cols-2 justify-center items-center gap-x-10">
		<div class="w-full order-1 md:w-52 md:order-1">
			<InfoDisplay label="Address" value={contact.address} />
		</div>
		<div class="w-full order-2 md:w-52 md:order-3">
			<InfoDisplay label="Phone" value={contact.phone_number} />
		</div>
		<div class="w-full order-3 md:w-52 md:order-2">
			<InfoDisplay label="Email" value={contact.email} />
		</div>
	</div>
</div>

<div class="w-32 mr-6 mb-6 md:hidden"></div>
<div class="w-full flex justify-center mt-9 md:hidden">
	<div class="w-64">
		<Button type="button" text="Edit" uppercase onClick={goToEdit} />
	</div>
</div>
