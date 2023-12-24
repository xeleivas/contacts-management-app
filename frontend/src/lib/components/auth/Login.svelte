<script>
	import Input from '$lib/components/elements/Input.svelte';
	import Button from '$lib/components/elements/Button.svelte';
	import ErrorsDisplay from '$lib/components/elements/ErrorsDisplay.svelte';
	import { z } from 'zod';
	import { goto } from '$app/navigation';
	import { isLoggedIn, login } from '$lib/stores/auth';

	let formData = { email: '', password: '' };
	let errors = [];

	const loginSchema = z.object({
		email: z.string().email({ message: 'Email must be a valid email address' }),
		password: z.string().min(8, { message: 'Password must be at least 8 characters long' })
	});

	const onSubmit = async () => {
		try {
			const { email, password } = loginSchema.parse(formData);

			await login(email, password);
			if ($isLoggedIn) goto('/');
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

<h1 class="mt-44 mb-12 text-custom-title font-black">Welcome</h1>
<form
	class="w-11/12 md:w-full max-w-lg flex flex-col justify-center items-center gap-y-5"
	on:submit|preventDefault={onSubmit}
>
	<ErrorsDisplay {errors} />

	<Input label="Email" type="text" placeholder="jhon@doe.com" bind:value={formData.email} />
	<Input
		label="Password"
		type="password"
		placeholder="**************"
		bind:value={formData.password}
	/>

	<!-- Submit button section -->
	<div class="w-64 mt-8">
		<Button type="submit" text="Login" uppercase />
	</div>
</form>
