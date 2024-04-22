interface Category {
  id: string;
  name: string;
}

export interface Product {
  id: number;
  name: string;
  slug: string;
  short_info: string;
  category_id: number;
  category: Category,
  subcategory_id?: number;
  price: number;
  subcategory?: Category;
  description: string;
  in_stock: boolean;
  visible: boolean;
}
