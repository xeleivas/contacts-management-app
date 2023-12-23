<script>
	export let label = 'Example';
	export let type = 'text';
	export let placeholder = '';
	export let value = '';
	export let required = false;
</script>

<div class="w-full mb-6">
	<!-- svelte-ignore a11y-label-has-associated-control -->
	<label class="text-xl font-bold text-custom-label mb-2">{label}</label>
	<!-- {...{ type }} is a workaround to avoid having to create multiple inputs due to certain issues with type being dynamic -->
	<input
		class="w-full text-custom-text bg-custom-pink text-base rounded-lg block px-6 py-5"
		type="text"
		bind:value
		{...{ type }}
		{placeholder}
		{required}
	/>
</div>
