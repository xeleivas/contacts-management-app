export default {
	async login(email, password) {
		const response = await window.axiosApi.post('/api/login', {
			email,
			password
		});
		return response.data;
	},

	async logout() {
		const response = await window.axiosApi.post('/api/logout');
		return response.data;
	},

	async getUser() {
		const response = await window.axiosApi.get('/api/user');
		return response.data;
	}
};
