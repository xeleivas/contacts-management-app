import { writable } from 'svelte/store';
import contactsService from '../services/contactsService';

export const contacts = writable([]);

/**
 * Get the contacts from the API and set them on the store
 */
export const getContacts = async () => {
	try {
		const response = await contactsService.getContacts();
		if (!Array.isArray(response)) throw new Error('Something went wrong while fetching contacts');

		contacts.set(response);
	} catch (error) {
		console.error(error);
	}
};

/**
 * Create a new contact and reload the contacts from the API
 * @param {Object} contact
 */
export const createContact = async (contact) => {
	try {
		await contactsService.createContact(contact);
		getContacts();
	} catch (error) {
		console.error(error);
	}
};

/**
 * Update a contact and reload the contacts from the API
 * @param {Object} contact Must contain an id
 */
export const updateContact = async (id, contact) => {
	try {
		await contactsService.updateContact(id, contact);
		getContacts();
	} catch (error) {
		console.error(error);
	}
};

/**
 * Delete a contact and reload the contacts from the API
 * @param {String} id
 */
export const deleteContact = async (id) => {
	try {
		await contactsService.deleteContact(id);
		getContacts();
	} catch (error) {
		console.error(error);
	}
};
