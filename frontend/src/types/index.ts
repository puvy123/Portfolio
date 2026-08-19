export interface ProfileStats {
  years_exp: string;
  projects_completed: string;
  happy_clients?: string;
  technologies_count?: string;
  code_commits?: string;
  coffee_cups?: string;
}

export interface Profile {
  name: string;
  title: string;
  bio: string;
  about_me_text?: string;
  avatar: string;
  location: string;
  cv_url: string;
  email?: string;
  github?: string;
  linkedin?: string;
  available_for_hire: boolean;
  stats: ProfileStats;
  settings?: Record<string, string>;
}

export interface SkillCategory {
  id: number;
  name: string;
  sort_order: number;
  skills?: Skill[];
}

export interface Skill {
  id: number;
  skill_category_id?: number;
  category?: SkillCategory | string;
  name: string;
  icon?: string;
  proficiency: number; // 1-100
  experience_years: string;
  is_featured: boolean;
  sort_order: number;
}

export interface Service {
  id: number;
  title: string;
  description: string;
  icon?: string;
  features?: string[];
  price?: number;
  is_active: boolean;
  sort_order: number;
}

export interface ProjectCategory {
  id: number;
  name: string;
  slug: string;
}

export interface ProjectImage {
  id: number;
  project_id: number;
  image_path: string;
  sort_order: number;
}

export interface Project {
  id: number;
  project_category_id?: number;
  category?: ProjectCategory;
  title: string;
  slug: string;
  summary: string;
  description: string;
  thumbnail: string;
  live_url?: string;
  github_url?: string;
  tags: string[];
  features?: string[];
  client?: string;
  start_date?: string;
  end_date?: string;
  is_featured: boolean;
  is_published: boolean;
  sort_order: number;
  images?: ProjectImage[];
}

export interface Experience {
  id: number;
  role: string;
  company: string;
  location?: string;
  period: string;
  description: string;
  achievements?: string[];
  technologies?: string[];
  is_current: boolean;
  sort_order: number;
}

export interface Education {
  id: number;
  institution: string;
  degree: string;
  field?: string;
  start_date?: string;
  end_date?: string;
  description?: string;
  sort_order: number;
}

export interface Certification {
  id: number;
  name: string;
  organization: string;
  credential_id?: string;
  issue_date?: string;
  expiration_date?: string;
  credential_url?: string;
  image?: string;
  sort_order: number;
}

export interface BlogCategory {
  id: number;
  name: string;
  slug: string;
  posts_count?: number;
}

export interface Tag {
  id: number;
  name: string;
  slug: string;
}

export interface BlogPost {
  id: number;
  blog_category_id?: number;
  category?: BlogCategory;
  title: string;
  slug: string;
  featured_image?: string;
  excerpt?: string;
  content: string;
  author?: string;
  published_at?: string;
  status: 'draft' | 'published';
  seo_title?: string;
  seo_description?: string;
  seo_keywords?: string;
  tags?: Tag[];
  created_at?: string;
}

export interface Testimonial {
  id: number;
  client_name: string;
  company?: string;
  role?: string;
  avatar?: string;
  content: string;
  rating: number;
  sort_order: number;
}

export interface SocialLink {
  id: number;
  platform: string;
  url: string;
  icon?: string;
  is_active: boolean;
  sort_order: number;
}

export interface ContactMessage {
  id: number;
  name: string;
  email: string;
  subject?: string;
  message: string;
  ip_address?: string;
  is_read: boolean;
  created_at: string;
}

export interface ContactPayload {
  name: string;
  email: string;
  subject?: string;
  message: string;
}

export interface PortfolioData {
  profile: Profile;
  skill_categories: SkillCategory[];
  skills: Skill[];
  services: Service[];
  project_categories: ProjectCategory[];
  projects: Project[];
  experiences: Experience[];
  educations: Education[];
  certifications: Certification[];
  testimonials: Testimonial[];
  social_links: SocialLink[];
}

export interface TerminalLog {
  id: string;
  command: string;
  output: string;
  type: 'info' | 'success' | 'error' | 'warning' | 'system';
  timestamp: string;
}
