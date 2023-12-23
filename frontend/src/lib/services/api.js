import axios from 'axios';
import config from '$lib/config';
import { browser } from '$app/environment';

// We get the access token from localStorage
const accessToken = browser ? localStorage.getItem('accessToken') : null;

// Set config defaults when creating the instance
export default axios.create({
	baseURL: config.apiUrl,
	headers: {
		'Content-Type': 'application/json',
		Accept: 'application/json',
		Authorization: `Bearer ${accessToken}`
	}
});
