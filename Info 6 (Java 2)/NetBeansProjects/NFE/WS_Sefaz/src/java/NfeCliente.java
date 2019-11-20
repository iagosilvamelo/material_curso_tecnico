import java.security.Security;

import br.inf.portalfiscal.www.nfe.wsdl.NfeStatusServico2.NfeStatusServico2Locator;
import br.inf.portalfiscal.www.nfe.wsdl.NfeStatusServico2.NfeStatusServico2Soap;

public class NfeCliente 
{
	public static void main(String[] args) 
	{
		try
		{
			System.setProperty("sun.security.ssl.allowUnsafeRenegotiation", "true");
			
			System.setProperty("java.protocol.handler.pkgs","com.sun.net.ssl.internal.www.protocol");
			Security.addProvider(new com.sun.net.ssl.internal.ssl.Provider());
			
			System.setProperty("javax.net.ssl.keyStoreType", "PKCS12");
			System.setProperty("javax.net.ssl.keyStore","C:\\Users\\Iago\\workspace\\ClienteNFE\\certificado.pfx");
			System.setProperty("javax.net.ssl.keyStoreAlias", "AliasdoCertificado");
			System.setProperty("javax.net.ssl.keyStorePassword", "SenhadoCertificado");
			
			System.setProperty("javax.net.ssl.trustStoreType", "JKS");
			System.setProperty("javax.net.ssl.trustStore","C:\\Users\\Iago\\workspace\\ClienteNFE\\KEYSTORE\\nfe.keystore");
			
			NfeStatusServico2Locator locator = new NfeStatusServico2Locator();
			NfeStatusServico2Soap service = locator.getNfeStatusServico2Soap();
			
			String nfeCabecMsg = null;
			String nfeDadosMsg = null;
			System.out.println(service.nfeStatusServicoNF2(nfeCabecMsg, nfeDadosMsg));
		} 
		catch(Exception e) 
		{
			System.out.println(e.getMessage()+ " "+ e.getCause());
		}
	}
}