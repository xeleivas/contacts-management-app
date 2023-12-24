import axios from 'axios';
import config from '$lib/config';
import { browser } from '$app/environment';

// We have this method to be able to create a fresh axios instance if needed
export const initApi = () => {
	if (!browser) return {};

	// We get the access token from localStorage
	const accessToken = localStorage.getItem('accessToken');

	// Set config defaults when creating the instance
	window.axiosApi = axios.create({
		baseURL: config.apiUrl,
		headers: {
			'Content-Type': 'application/json',
			Accept: 'application/json',
			Authorization: `Bearer ${accessToken}`
		}
	});

	// We use the window to keep a global reference to the axios instance, this helps specially when refreshing the token
	// The need for this is a side effect of using localStorage to store the token due to the cookie issues during development
	return window.axiosApi;
};

export default initApi();
