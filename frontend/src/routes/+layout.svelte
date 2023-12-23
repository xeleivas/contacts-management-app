<script>
	import '../app.css';
</script>

<div class="w-screen h-screen">
	<!-- Desktop navbar -->
	<div class="h-24 bg-custom-pink hidden md:flex p-4"></div>
	<!-- Slot section -->
	<div class="flex justify-center items-center">
		<div class="w-full">
			<slot />
		</div>
	</div>
</div>
