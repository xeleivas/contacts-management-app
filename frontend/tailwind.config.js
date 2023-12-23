/** @type {import('tailwindcss').Config} */
export default {
	content: ['./src/**/*.{html,js,svelte,ts}'],
	theme: {
		fontFamily: {
			sans: ['Red Hat Display', 'Public Sans', 'sans-serif']
		},
		extend: {
			colors: {
				'custom-title': '#120E21',
				'custom-label': '#26355C',
				'custom-text': '#99879D',
				'custom-pink': '#FBEEFF',
				'custom-purple': '#9378FF'
			},
			borderRadius: {
				button: '60px'
			}
			// borderWidth: {
			// 	'custom-border': '1px'
			// }
		}
	},
	plugins: []
};
