<script>
	import Button from '$lib/components/elements/Button.svelte';
	import { goto } from '$app/navigation';

	export let picture = '';
	export let name = '';
	export let contactId = 0;
	export let showEditButton = false;

	const goToEdit = () => {
		goto(`/contact/${contactId}/edit`);
	};
</script>

<div
	class="w-full h-44 flex flex-col justify-center items-center mt-11 md:h-full rounded-2xl bg-custom-pink border border-custom-pink md:bg-inherit md:border-0"
>
	<div class="w-full md:h-96 relative flex flex-col items-center mx-auto">
		<div class="w-full h-full md:h-80 relative flex justify-center rounded-xl bg-cover">
			<div
				class="w-full h-72 hidden absolute md:flex justify-end items-end rounded-2xl bg-custom-pink border border-custom-pink md:bg-custom-gray"
			>
				{#if showEditButton}
					<div class="w-32 mr-6 mb-6 hidden md:block">
						<Button type="button" text="Edit" uppercase onClick={goToEdit} />
					</div>
				{/if}
			</div>
			<div
				class="w-[82px] h-[82px] flex items-center justify-center rounded-full md:w-[186px] md:h-[186px] md:absolute md:-bottom-8 md:border-2 md:border-black"
			>
				<img class="h-full w-full rounded-full" src={picture} alt="" />
			</div>
		</div>
	</div>
	<div class="flex flex-col items-center mt-5 md:mt-3">
		<h4 class="text-2xl font-bold text-custom-title">{name}</h4>
	</div>
</div>
