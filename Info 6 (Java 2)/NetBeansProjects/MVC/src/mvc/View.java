package mvc;

public interface View {
    
    /**
     * Este método tem como função receber uma instancia 
     * da classe Model e exibi-la na Tela
     * @param m Instância da Classe de Modelagem
     */
    public void modelView(Model m);
    
    /**
     * Este método verifica os dados inseridos na tela  e retorna uma
     * instância da classe model
     * @return Instância da Classe de Modelagem
     */
    public Model viewModel();
    
    /**
     * método para limpar os campos da tela
     */
    public void clearView();
    
}
