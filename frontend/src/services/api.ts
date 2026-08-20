import axios from 'axios';
import type { PortfolioData, ContactPayload, BlogPost, BlogCategory } from '../types';

const API_BASE_URL = import.meta.env.VITE_API_URL || 'https://portfolio-0exg.onrender.com/api/v1';

export const apiClient = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
  timeout: 10000,
});

// Request interceptor to attach Bearer token
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem('puvy_admin_token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// ==========================================
// Public API Calls
// ==========================================

export async function fetchPortfolioData(): Promise<{ data: PortfolioData; isMock: boolean }> {
  try {
    const response = await apiClient.get('/portfolio');
    if (response.data && response.data.data) {
      return { data: response.data.data, isMock: false };
    }
    throw new Error('Invalid response structure');
  } catch (error) {
    console.warn('Backend API unavailable. Falling back to local state.', error);
    throw error;
  }
}

export async function sendContactForm(payload: ContactPayload): Promise<{ success: boolean; message: string }> {
  const response = await apiClient.post('/contact', payload);
  return {
    success: response.data.success ?? true,
    message: response.data.message || 'Message sent successfully!',
  };
}

export async function fetchBlogPosts(params?: { category?: string; search?: string; page?: number }): Promise<{
  data: BlogPost[];
  categories: BlogCategory[];
  meta: any;
}> {
  const response = await apiClient.get('/blog', { params });
  return response.data;
}

export async function fetchBlogPostBySlug(slug: string): Promise<{ data: BlogPost; related: BlogPost[] }> {
  const response = await apiClient.get(`/blog/${slug}`);
  return response.data;
}

// ==========================================
// Admin Authentication API Calls
// ==========================================

export async function adminLogin(email: string, pass: string) {
  const response = await apiClient.post('/auth/login', { email, password: pass });
  return response.data;
}

export async function adminLogout() {
  const response = await apiClient.post('/auth/logout');
  return response.data;
}

export async function fetchAdminDashboard() {
  const response = await apiClient.get('/admin/dashboard');
  return response.data;
}

// ==========================================
// Admin Generic CRUD Helpers
// ==========================================

export async function fetchAdminResource<T = any>(resource: string, params?: any): Promise<{ data: T[]; meta?: any }> {
  const response = await apiClient.get(`/admin/${resource}`, { params });
  return response.data;
}

export async function createAdminResource<T = any>(resource: string, payload: any): Promise<{ success: boolean; data: T; message: string }> {
  const response = await apiClient.post(`/admin/${resource}`, payload);
  return response.data;
}

export async function updateAdminResource<T = any>(resource: string, id: number, payload: any): Promise<{ success: boolean; data: T; message: string }> {
  const response = await apiClient.put(`/admin/${resource}/${id}`, payload);
  return response.data;
}

export async function deleteAdminResource(resource: string, id: number): Promise<{ success: boolean; message: string }> {
  const response = await apiClient.delete(`/admin/${resource}/${id}`);
  return response.data;
}

// Specific actions
export async function toggleMessageReadStatus(id: number) {
  const response = await apiClient.put(`/admin/messages/${id}/toggle-read`);
  return response.data;
}

export async function updateAdminProfile(payload: any) {
  const response = await apiClient.put('/admin/profile', payload);
  return response.data;
}

export async function saveAdminSettings(settings: Record<string, any>) {
  const response = await apiClient.post('/admin/settings', { settings });
  return response.data;
}
