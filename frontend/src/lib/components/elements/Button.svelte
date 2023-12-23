<script>
	export let text = '';
	export let type = 'submit';
	export let uppercase = false;
	export let onClick = () => {};
</script>

<button
	class="w-64 h-14 bg-custom-purple text-white text-lg font-medium rounded-button"
	class:uppercase
	{type}
	on:click={onClick}
>
	{text}
</button>
