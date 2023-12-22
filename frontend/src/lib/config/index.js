import { PUBLIC_API_URL } from '$env/static/public';
import { browser } from '$app/environment';

export default {
	apiUrl: PUBLIC_API_URL || 'http://localhost:8000',
	isBrowser: browser || false
};
