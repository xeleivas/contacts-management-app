<script>
	export let id = undefined;
	export let label = '';
	export let type = 'text';
	export let placeholder = '';
	export let value = '';
	export let required = false;

	let props = { id, label, type, placeholder, value, required };
</script>

<div class="w-full mb-6">
	{#if label}
		<!-- svelte-ignore a11y-label-has-associated-control -->
		<label class="text-xl font-bold text-custom-label mb-2">{label}</label>
	{/if}
	<!-- {...params} is a workaround to avoid having to create multiple inputs due to certain issues with type being dynamic -->
	{#if type === 'textarea'}
		<textarea
			class="w-full h-[69px] text-custom-text bg-custom-pink text-base rounded-lg break-words resize-none px-6 py-2"
			bind:value
			{...props}
		></textarea>
	{:else}
		<input
			class="w-full h-14 text-custom-text bg-custom-pink text-base rounded-lg block px-6 line-clamp-2"
			bind:value
			{...props}
		/>
	{/if}
</div>
