import api from './api';

export default {
	async getContacts() {
		const response = await api.get('/api/contacts');
		return response.data;
	},

	async createContact(contact) {
		const response = await api.post('/api/contacts', contact);
		return response.data;
	},

	async updateContact(id, contact) {
		const response = await api.put(`/api/contacts/${id}`, contact);
		return response.data;
	},

	async deleteContact(id) {
		const response = await api.delete(`/api/contacts/${id}`);
		return response.data;
	}
};
