import { Species } from "./Species";

export interface Animal {
    id: number;
    name: string;
    species: Species;
    breed: string;
    age: number;
    description?: string | null;
    price: number;
    image?: string | null;
    available: boolean;
    created_at?: string | null;
    updated_at?: string | null;
}
