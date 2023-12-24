import { writable, derived } from 'svelte/store';
import authService from '$lib/services/authService';
import { initApi } from '$lib/services/api';

export const user = writable(null);
export const isLoggedIn = derived(user, ($user) => !!$user);

/**
 * Login the user and sets the user and token on the store
 * @param {string} email
 * @param {string} password
 */
export const login = async (email, password) => {
	try {
		const response = await authService.login(email, password);
		if (!response?.user) throw new Error('Wrong credentials');

		user.set(response.user);
		// We use localStorage to store the accessToken,
		// just as a simple alternative to cookies due to CORS issues during development
		localStorage.setItem('accessToken', response.token);
		// Refresh axios instance, the initial one was created with no token on import time
		initApi();
	} catch (error) {
		console.error(error);
	}
};

/**
 * Logout the user and clears the user and token from the store
 */
export const logout = async () => {
	try {
		await authService.logout();
		user.set(null);
		localStorage.removeItem('accessToken');
	} catch (error) {
		console.error(error);
	}
};

/**
 * Check if there is a user logged in
 * If there is, set the user and token on the store
 */
export const checkAuth = async () => {
	try {
		const response = await authService.getUser();
		if (!response) return; // There is no user logged in, so we don't need to do anything

		user.set(response);
	} catch (error) {
		console.error(error);
	}
};
