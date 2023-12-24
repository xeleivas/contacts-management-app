<script>
	import Input from '$lib/components/elements/Input.svelte';
	import Button from '$lib/components/elements/Button.svelte';
	import ErrorsDisplay from '$lib/components/elements/ErrorsDisplay.svelte';
	import { z } from 'zod';
	import { goto } from '$app/navigation';
	import { createContact, updateContact } from '$lib/stores/contacts';

	export let contact = {};
	export let create = false;
	let errors = [];

	const contactSchema = z.object({
		name: z.string().min(1, { message: 'Name is required' }).max(100, {
			message: 'Name must be less than 100 characters long'
		}),
		email: z.string().email({ message: 'Email must be a valid email address' }),
		address: z.string().min(1, { message: 'Address is required' }).max(200, {
			message: 'Address must be less than 200 characters long'
		}),
		phone_number: z.string().min(1, { message: 'Phone number is required' }).max(50, {
			message: 'Phone number must be less than 50 characters long'
		}),
		profile_picture_url: z.string().min(1, { message: 'Profile picture is required' })
	});

	const goToDetails = (id) => {
		goto(`/contact/${id}`);
	};

	const goBack = () => {
		if (create) goto('/');
		else goToDetails(contact.id);
	};

	const onSubmit = async () => {
		try {
			const formContact = contactSchema.parse(contact);

			// We check for the operation type
			if (create) {
				contact = await createContact(formContact);
			} else {
				await updateContact(contact.id, formContact);
			}

			// If everything is successful, go to the details page
			goToDetails(contact.id);
		} catch (error) {
			// Identify the form validation errors and set them to the formData
			if (error instanceof z.ZodError) {
				errors = error.errors;
			} else {
				errors = [{ message: 'Something went wrong while validating the form' }];
			}
			console.log(error);
		}
	};
</script>

<form
	class="w-full flex flex-col justify-center items-center mt-8 md:mt-20"
	on:submit|preventDefault={onSubmit}
>
	<ErrorsDisplay {errors} />

	<div class="w-full flex justify-center items-center">
		<div
			class="w-full grid grid-cols-1 md:grid-cols-2 justify-center items-center md:w-auto md:gap-x-20"
		>
			<div class="w-full order-1 md:w-80 md:order-1">
				<Input label="Name" bind:value={contact.name} />
			</div>
			<div class="w-full order-2 md:w-80 md:order-3">
				<Input label="Profile Picture" bind:value={contact.profile_picture_url} />
			</div>
			<div class="w-full order-3 md:w-80 md:order-5">
				<Input label="Address" bind:value={contact.address} />
			</div>
			<div class="w-full order-4 md:w-80 md:order-2">
				<Input label="Phone" bind:value={contact.phone_number} />
			</div>
			<div class="w-full order-5 md:w-80 md:order-5">
				<Input label="Email" bind:value={contact.email} />
			</div>
		</div>
	</div>

	<!-- Submit button section -->
	<div
		class="w-full flex justify-center gap-3 absolute bottom-10 mt-10 md:relative md:bottom-auto md:gap-10 md:mt-8"
	>
		<div class="w-1/2 md:w-64">
			<Button type="button" text="Cancel" uppercase onClick={goBack} />
		</div>
		<div class="w-1/2 md:w-64">
			<Button type="submit" text="Save" uppercase />
		</div>
	</div>
</form>
