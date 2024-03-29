package mvc;

import mvc.Model;
import java.util.ArrayList;
import org.hibernate.Query;
import org.hibernate.Session;

public class Control {

    private ArrayList<Model> registros; //Armazena os registros em forma de registros
    private int indice = 0;//indica a posição do registro do ArrayList modelos
    private Model nulo;// armazena uma instancia nula da classe Model usada
    private String sql;
            /**
             * Contrutor do control
             *
             * @param registros Arraylist contedo objeto da classe model
             * @param nulo instância nula do objeto Model usado
             */

    public Control(java.util.ArrayList registros, String sql, Model nulo) {
        this.registros = registros;
        this.nulo = nulo;
        this.sql = sql;
        this.carrega_Db();
    }

    public void carrega_Db() {
        Session session = HibernateUtil.getSessionFactory().openSession();
        session.beginTransaction();
        Query q = session.createQuery(sql);
        registros = (ArrayList<Model>) q.list();
        session.getTransaction().commit();
    }

    /**
     * Aumenta o valor do indice em 1, respeitando o tamanho máximo do ArrayList
     */
    public void avancar() {
        int limite;//valor máximo que indice pode ter
        if (registros.isEmpty() == false)//verifica se o ArrayList não está vazio
        {
            limite = registros.size() - 1;
        } else {
            limite = 0;
        }

        if (indice < limite) {
            indice++;//somente aumente indice se ele estiver  abaixo
        } //do limite
        else {
            indice = limite;// garante que indice não seja maior que o limite
        }
    }

    /**
     * Reduz o valor do indice em 1, respeitando o tamanho minimo (0)
     */
    public void voltar() {
        if (indice > 0) {
            indice--;
        } else {
            indice = 0; //Garante que o indice não ficará negativo
        }
    }

    /**
     * Retorna o registro na posição atual de indice
     *
     * @return Instância da Classe de Modelagem
     */
    public Model exibir() {
        Model m = null;
        try {
            m = registros.get(indice);
        } catch (Exception e) {
            m = this.nulo;
        }
        return m;
    }

    /**
     * Adiciona um registro ao ArrayList
     *
     * @param m Instância da Classe de Modelagem
     */
    public void adicionar(Model m) {
        
            Session session = HibernateUtil.getSessionFactory().openSession();
            session.beginTransaction();
            session.save(m);
            session.getTransaction().commit();
            this.carrega_Db();
    }

    /**
     * Remove um registro no ArrayList em uma determinada posição
     *
     * @param registro Valor int que indica a posição do registro a ser excluido
     */
    public void excluir(int registro) {
            Session session = HibernateUtil.getSessionFactory().openSession();
            session.beginTransaction();
            session.delete(registros.get(indice));
            session.getTransaction().commit();
            this.carrega_Db();
    }

    /**
     * Remove um registro do ArrayList na posição atual de indice
     */
    public void excluir() {
        this.excluir(indice);
    }

    /**
     * Edita um registro atual, substituindo por outro. Na prática, exclui o
     * registro atual e substitui por outro co os dados atualizados.
     *
     * @param m Instância da Classe de Modelagem
     */
    public void editar(Model m) {
 
            Session session = HibernateUtil.getSessionFactory().openSession();
            session.beginTransaction();
            session.update(m);
            session.getTransaction().commit();
            this.carrega_Db();
        
    }

}
