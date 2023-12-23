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

<div class="flex flex-col items-center min-h-screen">
	<h1 class="mt-44 mb-12 text-blue-950 font-black">Welcome</h1>
	<form
		class="w-full max-w-lg flex flex-col justify-center items-center gap-y-5"
		on:submit|preventDefault={onSubmit}
	>
		{#if formData?.errors?.length}
			<ul class="font-medium tracking-wide text-red-500 text-sm">
				{#each formData.errors as error}
					<li>{error.message}</li>
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

		<Button type="submit" text="Login" />
	</form>
</div>
