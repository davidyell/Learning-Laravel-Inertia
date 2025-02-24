import { Species } from "./Species";

export interface Animal {
    id: number;
    name: string;
    species: Species;
    breed?: string | null;
    age?: number | null;
    description?: string | null;
    price?: number | null;
    image?: string | null;
    available: boolean;
    created_at?: string | null;
    updated_at?: string | null;
}
