<script>
	export let errors = [];
</script>

{#if errors?.length}
	<ul class="flex flex-col justify-center font-medium tracking-wide text-red-500 text-sm mb-4">
		{#each errors as error}
			<li class="mx-auto">{error.message}</li>
		{/each}
	</ul>
{/if}
