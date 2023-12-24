export default {
	async getContacts() {
		const response = await window.axiosApi.get('/api/contacts');
		return response.data;
	},

	async createContact(contact) {
		const response = await window.axiosApi.post('/api/contacts', contact);
		return response.data;
	},

	async updateContact(id, contact) {
		const response = await window.axiosApi.put(`/api/contacts/${id}`, contact);
		return response.data;
	},

	async deleteContact(id) {
		const response = await window.axiosApi.delete(`/api/contacts/${id}`);
		return response.data;
	}
};
