<script>
	export let text = '';
	export let type = 'submit';
	export let uppercase = false;
	export let onClick = () => {};
</script>

<button
	class="w-full h-14 bg-custom-purple text-white text-lg font-medium rounded-button"
	class:uppercase
	{type}
	on:click={onClick}
>
	{text}
</button>
