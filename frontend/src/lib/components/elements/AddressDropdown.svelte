<script>
	import Input from '$lib/components/elements/Input.svelte';
	import { onMount } from 'svelte';
	import config from '$lib/config';

	export let value = '';

	const initMap = () => {
		const input = document.getElementById('autocomplete');
		const options = {
			fields: ['formatted_address'],
			types: ['address'],
			strictBounds: false
		};
		const autocomplete = new google.maps.places.Autocomplete(input, options);

		autocomplete.addListener('place_changed', () => {
			const place = autocomplete.getPlace();
			value = place.formatted_address;
		});
	};

	onMount(() => {
		initMap();
	});
</script>

<svelte:head>
	<script>
		// Workaround to avoid initialization errors
		window.initMap = () => ({});
	</script>
	<script
		async
		src={`https://maps.googleapis.com/maps/api/js?key=${config.placesApiKey}&libraries=places&language=en&callback=initMap`}
	></script>
</svelte:head>

<div class="autocomplete-address">
	<Input id="autocomplete" label="Address" type="textarea" bind:value />
</div>
