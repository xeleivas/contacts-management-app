<script>
	export let label = '';
	export let type = 'text';
	export let placeholder = '';
	export let value = '';
	export let required = false;
</script>

<div class="w-full mb-6">
	{#if label}
		<!-- svelte-ignore a11y-label-has-associated-control -->
		<label class="text-xl font-bold text-custom-label mb-2">{label}</label>
	{/if}
	<!-- {...{ type }} is a workaround to avoid having to create multiple inputs due to certain issues with type being dynamic -->
	<input
		class="w-full h-14 text-custom-text bg-custom-pink text-base rounded-lg block px-6"
		bind:value
		{...{ type }}
		{placeholder}
		{required}
	/>
</div>
