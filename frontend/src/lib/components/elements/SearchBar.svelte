<script>
	export let value = '';
</script>

<div class="w-full relative">
	<div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
		<img src="img/search-icon.svg" alt="Search Icon" />
	</div>
	<input
		type="search"
		class="w-full h-11 px-12 text-sm text-custom-text bg-white border border-custom-pink rounded-lg"
		bind:value
	/>
</div>
