<?
class Brand {
    private $id;
    private $name;
    private $dateModified;

    /**
     * Constructeur de la classe Brand.
     * @param int $id L'ID de la marque.
     * @param string $name Le nom de la marque.
     * @param string $dateModified La date de modification de la marque.
     */
    public function __construct($id, $name, $dateModified) {
        $this->id = $id;
        $this->name = $name;
        $this->dateModified = $dateModified;
    }

}
class BrandManager {
    private $db; // L'objet de connexion à la BDD

    /**
     * Constructeur de la classe BrandManager.
     * 
     * @param mysqli $db L'objet de connexion à la BDD.
     * 
     */
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Récupère toutes les marques.
     * @return array Un tableau contenant toutes les marques.
     */
    public function findAll() {
        $query = "SELECT * FROM brands";
        $result = $this->db->query($query);
        $brands = [];

        while ($row = $result->fetch_assoc()) {
            $brands[] = new Brand($row['id'], $row['name'], $row['date_modified']);
        }

        return $brands;
    }

    /**
     * Récupère une marque grâce à son ID.
     * 
     * @param int $id L'ID de la marque à récupérer.
     * 
     * @return Brand|null La marque correspondante ou null si rien n'est trouvé.
     */
    public function find($id) {
        $id = $this->db->real_escape_string($id);
        $query = "SELECT * FROM brands WHERE id = $id";
        $result = $this->db->query($query);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return new Brand($row['id'], $row['name'], $row['date_modified']);
        }

        return null;
    }
}