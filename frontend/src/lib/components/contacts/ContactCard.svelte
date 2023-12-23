<script>
	export let contact = {};
	export let noBackground = false;

	const truncate = (string, length) => {
		return string.length > length ? string.substring(0, length - 3) + '...' : string;
	};
</script>

<div
	class="w-full h-[119px] relative flex flex-col justify-center items-start px-7 md:bg-white md:border-custom-pink md:rounded-2xl md:max-w-80"
	class:bg-transparent={noBackground}
	class:border-transparent={noBackground}
	class:bg-white={!noBackground}
	class:border-custom-pink={!noBackground}
>
	<a href={`/contact/${contact.id}`} class="cursor-pointer">
		<div class="mx-0 my-auto flex items-center gap-5 overflow-hidden rounded-xl shadow-none">
			<img
				src={contact.profile_picture_url}
				alt="Profile"
				class="w-14 h-14 inline-block !rounded-full object-cover object-center md:w-[74px] md:h-[74px]"
			/>
			<div class="w-full flex flex-col gap-0.5">
				<div class="flex items-center justify-between">
					<h5 class="text-xl font-bold text-custom-title truncate">
						{truncate(contact.name, 30)}
					</h5>
					<img class="absolute right-0 mr-5 mt-5 md:mt-0" src="img/arrow-right.svg" alt="Arrow" />
				</div>
				<p class="text-xs text-custom-text truncate">
					{truncate(contact.address, 30)}
				</p>
			</div>
		</div>
	</a>
</div>
