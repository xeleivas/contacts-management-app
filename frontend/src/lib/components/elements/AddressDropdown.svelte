<script>
	import Input from '$lib/components/elements/Input.svelte';
	import { onMount } from 'svelte';

	export let value = '';

	const initMap = () => {
		if (!google) return;

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

<div class="autocomplete-address">
	<Input id="autocomplete" label="Address" type="textarea" bind:value />
</div>
