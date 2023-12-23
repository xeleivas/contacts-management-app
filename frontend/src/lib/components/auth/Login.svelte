<script>
	import Input from '../elements/Input.svelte';
	import Button from '../elements/Button.svelte';
	import { z } from 'zod';
	import { goto } from '$app/navigation';
	import { isLoggedIn, login } from '$lib/stores/auth';

	let formData = {
		email: '',
		password: '',
		errors: []
	};

	const loginSchema = z.object({
		email: z
			.string({ required_error: 'Email is required' })
			.email({ message: 'Email must be a valid email address' }),
		password: z
			.string({ required_error: 'Password is required' })
			.min(8, { message: 'Password must be at least 8 characters long' })
	});

	const onSubmit = async () => {
		try {
			const { email, password } = loginSchema.parse(formData);

			await login(email, password);
			if ($isLoggedIn) goto('/');
		} catch (error) {
			// Identify the form validation errors and set them to the formData
			if (error instanceof z.ZodError) {
				formData.errors = error.errors;
			} else {
				formData.errors = [{ message: 'Something went wrong while validating the form' }];
			}
			console.log(error);
		}
	};
</script>

<h1 class="mt-44 mb-12 text-blue-950 font-black">Welcome</h1>
<form
	class="w-11/12 md:w-full max-w-lg flex flex-col justify-center items-center gap-y-5"
	on:submit|preventDefault={onSubmit}
>
	{#if formData?.errors?.length}
		<ul class="flex flex-col justify-center font-medium tracking-wide text-red-500 text-sm">
			{#each formData.errors as error}
				<li class="mx-auto">{error.message}</li>
			{/each}
		</ul>
	{/if}

	<Input label="Email" type="text" placeholder="jhon@doe.com" bind:value={formData.email} />
	<Input
		label="Password"
		type="password"
		placeholder="**************"
		bind:value={formData.password}
	/>

	<!-- Submit button section -->
	<div class="mt-8">
		<Button type="submit" text="Login" uppercase />
	</div>
</form>
