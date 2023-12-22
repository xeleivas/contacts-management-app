import api from './api';

export default {
	async login(email, password) {
		const response = await api.post('/api/login', {
			email,
			password
		});
		return response.data;
	},

	async getUser() {
		const response = await api.get('/api/user');
		return response.data;
	}
};
