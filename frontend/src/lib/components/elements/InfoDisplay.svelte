<!-- Similar component to Input, but for display only -->
<script>
	export let label = '';
	export let value = '';
</script>

<div class="w-full mb-6">
	{#if label}
		<!-- svelte-ignore a11y-label-has-associated-control -->
		<label class="text-xl font-bold text-custom-title mb-2">{label}</label>
	{/if}
	<div class="w-full h-14 text-custom-text bg-transparent text-base rounded-lg mt-3 line-clamp-2">
		{value}
	</div>
</div>
